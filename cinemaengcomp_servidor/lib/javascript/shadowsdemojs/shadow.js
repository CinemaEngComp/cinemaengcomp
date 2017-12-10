/* It would probably be a good idea to do some kind of basic DOM or
   browser check in any code that uses this technique. I don’t bother
   here because this is just a demo. */

init();

function init() {
  var oldOnLoad = window.onload;
  window.onload = function() {
    if (oldOnLoad) oldOnLoad();
    addMattesAndShadows();
  }
}

function addMattesAndShadows() {

/*

1. Get all the imgs in the document.
2. Step through the imgs, identifying the shadow ones. (Hi, DOM guys?
   A getElementByCSSSelector functon would kick ass. Kay? Thanks.)
3. For each img of class shadow:
   a. Create a new div node of class shadow.
   b. Set the width of the new node to the width of the img plus a little
      extra to accommodate the matte we’re adding.
   c. Add a clone of the img to the new div as a child.
   d. Create the four corner divs and add them to the new div as children.
   e. Replace the img with the new shadow div.

I’m going to identify each step as I go, so if you see something that doesn’t
make sense, just look for the closest number.

*/

  /* 1. */
  var imgs = document.getElementsByTagName("img");

  /* 2. */
  for (var i = 0; i < imgs.length; i++) {
    var thisImg = imgs[i];
    var isShadow = false;
    var extraWidth = 10;

    /* A word about extraWidth. This value represents the width of the white
       matte we’re adding around our shadowed images. I like a five-pixel
       matte, hence extraWidth equals ten.

       Yes, it’s lame to hard-code the matte into both the CSS and the
       JavaScript. We are, in fact, just asking for trouble by doing it this
       way. But after literally tens of seconds of intense thought, I failed
       to come up with a more clever solution. If you feel like tackling
       it, knock yourself out. Since I’m only applying one kind of matte
       per site-wide instance of this technique, I really don’t care. */

    if (thisImg.className) {

      /* First we’ll tokenize the className, since classes can have multiple
         space-separated values. */

      var classTokens = thisImg.className.split(' ');
      for (var j = 0; j < classTokens.length; j++) {
        var thisToken = classTokens[j];
        if (thisToken == "shadow")
          isShadow = true;
        if (thisToken == "nomatte")
          extraWidth = 0;
      }

      /* If thisImg is a shadow image … um  apply the shadow. Duh. */

      /* 3. */
      if (isShadow) {

        /* 3a. */
        var shadowDiv = document.createElement('div');
        shadowDiv.className = 'shadow';
        /* Yes, you can use setAttribute, but this way works in IE too. */

        /* 3b. */
        shadowDiv.style.width = (thisImg.width + extraWidth) + "px";

        /* 3c. */
        shadowDiv.appendChild(thisImg.cloneNode(false));
        /* Img elements can’t have children in HTML, so no need for a deep
           clone. That’s what the “false” argument means. Stupid C-like
           non-named-arguments having JavaScript syntax. */

        /* 3d. */
        var topLeft = document.createElement('div');
        topLeft.className = "topleft";
        shadowDiv.appendChild(topLeft);

        var topRight = document.createElement('div');
        topRight.className = "topright";
        shadowDiv.appendChild(topRight);

        var bottomLeft = document.createElement('div');
        bottomLeft.className = "bottomleft";
        shadowDiv.appendChild(bottomLeft);

        var bottomRight = document.createElement('div');
        bottomRight.className = "bottomright";
        shadowDiv.appendChild(bottomRight);

        /* 3e. */
        thisImg.parentNode.replaceChild(shadowDiv, thisImg);

      }

    }

  }

}