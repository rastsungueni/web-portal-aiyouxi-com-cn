<?php

namespace App\Render;

class LinkCard
{
    private string $siteName;
    private string $siteUrl;
    private string $title;
    private string $description;
    private string $imageUrl;

    public function __construct(
        string $siteName = '爱游戏',
        string $siteUrl = 'https://web-portal-aiyouxi.com.cn',
        string $title = '',
        string $description = '',
        string $imageUrl = ''
    ) {
        $this->siteName = $siteName;
        $this->siteUrl = $siteUrl;
        $this->title = $title ?: $siteName . ' 官方门户';
        $this->description = $description ?: "欢迎来到{$siteName}，探索精彩游戏世界。";
        $this->imageUrl = $imageUrl ?: $siteUrl . '/assets/default-card.png';
    }

    public function render(): string
    {
        $escapedUrl = htmlspecialchars($this->siteUrl, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDesc = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedImage = htmlspecialchars($this->imageUrl, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedSite = htmlspecialchars($this->siteName, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $html = '<div class="link-card">' . PHP_EOL;
        $html .= '    <a href="' . $escapedUrl . '" target="_blank" rel="noopener noreferrer">' . PHP_EOL;
        $html .= '        <div class="card-image">' . PHP_EOL;
        $html .= '            <img src="' . $escapedImage . '" alt="' . $escapedTitle . '" loading="lazy">' . PHP_EOL;
        $html .= '        </div>' . PHP_EOL;
        $html .= '        <div class="card-body">' . PHP_EOL;
        $html .= '            <h3 class="card-title">' . $escapedTitle . '</h3>' . PHP_EOL;
        $html .= '            <p class="card-description">' . $escapedDesc . '</p>' . PHP_EOL;
        $html .= '            <span class="card-site">' . $escapedSite . '</span>' . PHP_EOL;
        $html .= '        </div>' . PHP_EOL;
        $html .= '    </a>' . PHP_EOL;
        $html .= '</div>' . PHP_EOL;

        return $html;
    }

    public static function fromConfig(array $config): self
    {
        return new self(
            siteName: $config['site_name'] ?? '爱游戏',
            siteUrl: $config['site_url'] ?? 'https://web-portal-aiyouxi.com.cn',
            title: $config['title'] ?? '',
            description: $config['description'] ?? '',
            imageUrl: $config['image_url'] ?? ''
        );
    }

    public static function sampleCard(): string
    {
        $card = new self();
        return $card->render();
    }
}