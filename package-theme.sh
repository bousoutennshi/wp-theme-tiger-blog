#!/bin/bash

# TIGER BLOG WordPress Theme Packaging Script
# This script creates a ZIP file ready for WordPress theme upload

echo "🎨 TIGER BLOG Theme Packaging"
echo "================================"

# Set variables
THEME_NAME="tiger-blog"
TIMESTAMP=$(date +%Y%m%d_%H%M%S)
OUTPUT_FILE="${THEME_NAME}_${TIMESTAMP}.zip"
TEMP_DIR="temp_${THEME_NAME}"

# Clean up any previous temp directory
if [ -d "$TEMP_DIR" ]; then
    echo "🧹 Cleaning up previous temp directory..."
    rm -rf "$TEMP_DIR"
fi

# Create temporary directory
echo "📁 Creating temporary directory..."
mkdir -p "$TEMP_DIR/$THEME_NAME"

# Copy necessary files
echo "📋 Copying theme files..."

# Root PHP files
cp *.php "$TEMP_DIR/$THEME_NAME/" 2>/dev/null || true

# Root CSS and JSON files
cp style.css style-editor.css theme.json "$TEMP_DIR/$THEME_NAME/" 2>/dev/null || true

# Copy directories
echo "📂 Copying directories..."
cp -r assets "$TEMP_DIR/$THEME_NAME/" 2>/dev/null || true
cp -r css "$TEMP_DIR/$THEME_NAME/" 2>/dev/null || true
cp -r fonts "$TEMP_DIR/$THEME_NAME/" 2>/dev/null || true
cp -r img "$TEMP_DIR/$THEME_NAME/" 2>/dev/null || true
cp -r inc "$TEMP_DIR/$THEME_NAME/" 2>/dev/null || true

# Copy README and LICENSE
cp README.md LICENSE "$TEMP_DIR/$THEME_NAME/" 2>/dev/null || true

# Create ZIP file
echo "🗜️  Creating ZIP archive..."
cd "$TEMP_DIR"
zip -r "../$OUTPUT_FILE" "$THEME_NAME" -q

# Clean up
cd ..
echo "🧹 Cleaning up..."
rm -rf "$TEMP_DIR"

# Check if ZIP was created successfully
if [ -f "$OUTPUT_FILE" ]; then
    SIZE=$(du -h "$OUTPUT_FILE" | cut -f1)
    echo ""
    echo "✅ Success!"
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
    echo "📦 Theme package created: $OUTPUT_FILE"
    echo "📊 File size: $SIZE"
    echo ""
    echo "🚀 Next steps:"
    echo "1. Go to WordPress Admin → Appearance → Themes"
    echo "2. Click 'Add New' → 'Upload Theme'"
    echo "3. Upload $OUTPUT_FILE"
    echo "4. Activate the theme"
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
else
    echo ""
    echo "❌ Error: Failed to create ZIP file"
    exit 1
fi
