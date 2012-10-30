

      <?php if (!is_front_page()): ?>
          <div class="row-fluid">
            <div class="span12">
              <br>
              <br>
              <br>
              <p>
                <!-- AddThis Button BEGIN -->
                <a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=300&amp;pubid=xa-506d562f0fcc2f96"><img src="http://s7.addthis.com/static/btn/v2/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a>
                <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-506d562f0fcc2f96"></script>
                <!-- AddThis Button END -->
              </p>
            </div>
          </div>
        <?php endif; ?>
          <footer>
            <p>
              Copyright © 2012 CrossBorder Technologies AB
            </p>
            <p>
              Address: Sjöviksvägen 2, 231 62 Trelleborg, Sweden   |   Phone: +46 410 35 35 90   |   Email: <a href="mailto:info@xbrdr.com">info@xbrdr.com</a>
            </p>
          </footer>
          <script>
          /*! A fix for the iOS orientationchange zoom bug. Script by @scottjehl, rebound by @wilto.MIT / GPLv2 License.*/(function(a){function m(){d.setAttribute("content",g),h=!0}function n(){d.setAttribute("content",f),h=!1}function o(b){l=b.accelerationIncludingGravity,i=Math.abs(l.x),j=Math.abs(l.y),k=Math.abs(l.z),(!a.orientation||a.orientation===180)&&(i>7||(k>6&&j<8||k<8&&j>6)&&i>5)?h&&n():h||m()}var b=navigator.userAgent;if(!(/iPhone|iPad|iPod/.test(navigator.platform)&&/OS [1-5]_[0-9_]* like Mac OS X/i.test(b)&&b.indexOf("AppleWebKit")>-1))return;var c=a.document;if(!c.querySelector)return;var d=c.querySelector("meta[name=viewport]"),e=d&&d.getAttribute("content"),f=e+",maximum-scale=1",g=e+",maximum-scale=10",h=!0,i,j,k,l;if(!d)return;a.addEventListener("orientationchange",m,!1),a.addEventListener("devicemotion",o,!1)})(this);
          </script>
        </div>
      </div>
    </div>
    <?php wp_footer(); ?>
  </body>
</html>
