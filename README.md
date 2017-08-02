# 📹 HTML5-Video Kirbytag by [@wottpal](https://twitter.com/wottpal)
![](https://img.shields.io/github/release/wottpal/kirby-video/all.svg)

The last kirbytag for HTML5-videos you'll ever need. 👊
<br>(*Disclaimer:* When it's tested a bit more.)

* **Dynamic Video- & Image-Source Recognition**
* **Lazy-Loading of all sources**
* **Placeholder-Color until the video has loaded to increase Perceived-Performance**<sup>1</sup> <sup>2</sup>
* **Use Fallback Images or GIFs**
* **Configurable & Customizable to it's core**

***

<sup>1</sup> Works out of the box with [kirby-dominant-color](https://github.com/iandoe/kirby-dominant-color) by @iandoe if fallback-image is provided<br>
<sup>2</sup> For consistency the fade-out transition looks exactly like the `color`-placeholder in [ImageSet](https://github.com/fabianmichael/kirby-imageset) by @fabianmichael


## 🐼 Demos

*Coming Soon* ([submit your demo](https://twitter.com/wottpal))

![Demo of HTML5-Video Kirbytag](demo.gif)


## 🐸 Installation

Use [Kirby's CLI](https://github.com/getkirby/cli) and install the plugin via: `kirby plugin:install wottpal/kirby-video` or place the repo manually under `site/plugins`.

Include styles in your `<head>`) with `<?= css('assets/plugins/video/video.min.css') ?>`.<sup>1</sup>

Include scripts before the end of your `</body>` with `<?= js('assets/plugins/video/video.min.js') ?>`.<sup>2</sup>

*****

<sup>1</sup> Necessary for placeholder-color and ratio-sizing.<br>
<sup>2</sup> Necessary for lazy-loading and img/gif fallback.


## 🐨 Usage
It's pretty straightforward to use this Kirbytag, the only rule to follow is basically: **Give all your source-files (and fallback-image) the same filename. Only the file-extensions should differ.**<sup>1</sup>

So, if you embed a video you only have to specify that base-filename and the plugin determines all matching files automagically. If you want to specify file-types/-formats or the source-order please see *Options*.

```
(video: funniest_thing_ever)
```

#### Video-Options & Presets

You can also manually specify options for the `<video>` element. In addition to the [spec-compliant attributes](https://www.w3schools.com/tags/tag_video.asp) you can also use `lazyload` to enable lazy-loading. Options are seperated by spaces.

```
Same as first:
(video: funniest_thing_ever options: lazyload controls)

GIF-like behavior:
(video: funniest_thing_ever options: lazyload autoplay loop muted playsinline)
```

These two options are also bundled in presets by default. You can add/modify presets by your own (see *Options*).

```
Same as first:
(video: funniest_thing_ever preset: default)

GIF-like behavior:
(video: funniest_thing_ever preset: gif)
```

#### Sizing

By default videos are displayed in their native resolutions. But you can specify `width` and `height`.<sup>2</sup>

```
(video: funniest_thing_ever width: 500px height: 300px)
```

#### Color

If you don't use [kirby-dominant-color](https://github.com/iandoe/kirby-dominant-color) you can manually specify the placeholder-color with the `color`-option. This also overwrites the dominant-color if given. If neither a dominiant-color is available nor you've specified `color` then `#fff` is used. To change this default see *Options*.


*****

<sup>1</sup>They also should have the same dimensions. I haven't tested anything else.<br>
<sup>2</sup> Theoretically you can also specify these in `options` but if you also want to set a preset, these get overwritten by it.


## 🦊 Options

The following options can be set globally in your `config.php` with `c::set($key, $value = null)`. You can also set multiple keys with `c::set([$key => $value, ..])`. 🤓


*****

* `video.kirbytext.tagname` (default: `'video'`)

*The name of the tag to embed a video within kirbytext.*

*****

* `video.kirbytext.class` (default: `''`)

*Additional class which is added to all video-elements.*

*****

* `video.kirbytext.default.color` (default: `'#fff'`)

*The default color of the placeholder.*

*****

* `video.kirbytext.merge.presets` (default: `[]`)

*Add your own presets to the default presets or modify them. See Usage above for the two default presets `default` and `gif`.*

*****

* `video.kirbytext.video.types`  (default underneath)

```
[
  'webm' => 'video/webm; codecs="vp9"',
  'mp4' => 'video/mp4',
  'ogg' => 'video/ogg'
]
```

*Specify all video-filetypes (and their respective type-attributes) you want the plugin to look for. The order is the same of the resulting `<source>` elements.*

Note: It's totally fine if you don't supply all of these. But at least one has to be available, otherwise no `<video>` is generated.

*****

* `video.kirbytext.image.formats`  (default: `['gif', 'jpeg', 'jpg', 'png']`)

*The image-extensions which are used to find a fallback-image. The first found file is used an the others are ignored.*

*****


## 🐻 Changelog

Have a look at the [releases page](https://github.com/wottpal/kirby-video/releases).


## 🦁 Roadmap

- [ ] Option to disable Preview-Color
- [ ] Option to disable `<figure>` wrapper
- [ ] Option to specify ratio + ratio-placeholders to prevent page-reflow when ratio is given. (like in ImageSet)
- [ ] Doesn't seem to work with @bastianallgeier's `columns`-kirbytag 😢
- [ ] Maybe use responsive fallback images


## 🐯 For Reference

### Interesting reads on `<video>` usage

* [Webkit-Blog](https://webkit.org/blog/6784/new-video-policies-for-ios/)
* [ImageOptim API](https://imageoptim.com/api/ungif)

### Alternative Plugins/Snippets

* [kirby-kirbytag-html5video](https://github.com/jbeyerstedt/kirby-kirbytag-html5video) by @jbeyerstedt
* [snippet.video.php](https://gist.github.com/jancbeck/a87c34e4df5b8764efb9) by @jancbeck


# 👨‍💻 Development
For minification and transpilation I use [Gulp](http://gulpjs.com). Please note that all files under `assets/` are only the generated ones from `src_assets/`.

```
# Install Dependencies
npm i

# Or: Install Dependencies for Hipsters
yarn

# Build & Watch (Install 'gulp-cli' globally to omit the 'npx')
npx gulp
```


## 💰‍ Pricing
Just kidding. This plugin is totally free. Please consider following [me](https://twitter.com/wottpal) on Twitter if it saved your day.
