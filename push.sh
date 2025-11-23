#!/bin/bash
# اسم الملف: combine_php.sh

OUTPUT_FILE="all_php_files.txt"

# مسح الملف إذا كان موجوداً
> "$OUTPUT_FILE"

find . -name "*.php" | while read -r file; do
    echo "==================================================" >> "$OUTPUT_FILE"
    echo "=== FILE: $file" >> "$OUTPUT_FILE"
    echo "==================================================" >> "$OUTPUT_FILE"
    cat "$file" >> "$OUTPUT_FILE"
    echo -e "\n\n" >> "$OUTPUT_FILE"
done

echo "تم دمج جميع ملفات PHP في $OUTPUT_FILE"