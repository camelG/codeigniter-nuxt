composer install
npm install
rm -rf dist
npm run generate
cp -rf dist/* public_html/
