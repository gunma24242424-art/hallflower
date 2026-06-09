import os
import xml.etree.ElementTree as ET

DOMAIN = "https://www.hallflower.com"
OUTPUT_FILE = "sitemap.xml"

def create_sitemap():
    root = ET.Element("urlset", xmlns="http://www.sitemaps.org/schemas/sitemap/0.9")
    count = 0
    # 현재 폴더(.)부터 모든 하위 폴더를 검색
    for dirpath, dirnames, filenames in os.walk("."):
        if "index.html" in filenames:
            path = dirpath.replace("\\", "/").lstrip("./")
            if not path: continue 
            url_node = ET.SubElement(root, "url")
            ET.SubElement(url_node, "loc").text = f"{DOMAIN}/{path}/index.html"
            ET.SubElement(url_node, "changefreq").text = "daily"
            count += 1
    
    tree = ET.ElementTree(root)
    with open(OUTPUT_FILE, "wb") as f:
        tree.write(f, encoding="utf-8", xml_declaration=True)
    print(f"완료: {count}개 페이지 인덱싱 성공")

if __name__ == "__main__":
    create_sitemap()