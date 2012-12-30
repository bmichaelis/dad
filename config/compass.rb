require "rubygems"
require "bundler/setup"
require "zurb-foundation"

sass_dir              = "assets/stylesheets"
cache_dir             = "resources/tmp/cache/sass-cache"

css_dir               = "webroot/css"
http_stylesheets_path = "/css"

fonts_dir             = "webroot/fonts"
http_fonts_path       = "/fonts"

images_dir            = "webroot/img"
http_images_path      = "/img"

javascripts_dir       = "webroot/js"
http_javascripts_path = "/js"

environment           = :production
output_style          = (environment == :production) ? :compressed : :expanded