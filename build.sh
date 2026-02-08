#!/bin/bash

# Set nodebrew PATH
export PATH=$HOME/.nodebrew/current/bin:$PATH

# Run npm install and build
cd /Users/myokota/git/wp-theme-tiger-blog

echo "Installing terser..."
npm install

echo "Building..."
npm run build
