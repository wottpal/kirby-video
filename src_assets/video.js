/**
* A module for <video> elements featuring lazyload, img-fallback and preview-color.
*/

const video = (() => {

  /* Private Functions */

  /**
   * Hides the placeholder by settig the loaded attribute as event-callback.
   */
  function hidePlaceholder(event) {
    event.target.setAttribute('loaded', true)
  }

  /**
  * Hides the placeholder when the video/fallback-img has loaded.
  */
  function hidePlaceholderOnLoad(videoEl) {
    videoEl.onloadeddata = hidePlaceholder
    const fallbackImg = videoEl.querySelector('img')
    if (fallbackImg) fallbackImg.onload = hidePlaceholder
  }

  /**
  * Initializes Image-Fallback
  */
  function initImageFallback(videoEl) {
    const lastSource = videoEl.querySelector('source:last-of-type')
    if (!lastSource) return

    lastSource.onerror = () => {
      const img = videoEl.querySelector('img');
      if (img) videoEl.parentNode.replaceChild(img, videoEl);
    }
  }

  /**
  * Initializes lazyload by swapping all 'data-src'-attributes with 'src'
  */
  function initLazyload(videoEl) {
    let childEls = Array.from(videoEl.children)
    if (!childEls || childEls.length <= 0) return

    childEls.reverse().forEach(childEl => {
      const src = childEl.getAttribute('data-src')
      if (!src || src == '') return
      childEl.setAttribute('src', src)
      childEl.removeAttribute('data-src')
    })

    videoEl.load()
    if (videoEl.hasAttribute('autoplay')) videoEl.play()
  }


  /* Public Functions */

  return {

    'initialize': () => {
      const videoEls = Array.from(document.querySelectorAll('video'))
      if (!videoEls || videoEls.length <= 0) return

      videoEls.forEach(hidePlaceholderOnLoad)

      videoEls.filter(videoEl => {
        return videoEl.hasAttribute('lazyload')
      }).forEach(initLazyload)

      videoEls.forEach(initImageFallback)
    }

  }

})();



document.addEventListener('DOMContentLoaded', video.initialize)
