<?php
$domain = "https://www.hallflower.com";
$sitemap_file = "sitemap.xml";
$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"/>');

// 현재 디렉토리의 모든 항목 탐색
$dir = new DirectoryIterator(dirname(__FILE__));
foreach ($dir as $fileinfo) {
    if ($fileinfo->isDir() && !$fileinfo->isDot()) {
        $folderName = $fileinfo->getFilename();
        // 폴더 내에 index.html이 있는지 확인
        if (file_exists($fileinfo->getPathname() . '/index.html')) {
            $url = $xml->addChild('url');
            // URL 인코딩 처리
            $url->addChild('loc', $domain . '/' . rawurlencode($folderName) . '/index.html');
            $url->addChild('changefreq', 'daily');
            $url->addChild('priority', '0.8');
        }
    }
}

// 파일 저장
$xml->asXML($sitemap_file);
echo "사이트맵 생성이 완료되었습니다: <a href='$sitemap_file'>$sitemap_file 확인</a>";
?>