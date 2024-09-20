(function ($) {
  "use strict";

  /*----------- 01. Print and Download Button ----------*/
  (function ($) {
    "use strict";
  
    /*----------- 01. Download as Image Button ----------*/
    $('#download_btn').on('click', function () {
        var downloadSection = $('#download_section');
        var scale = 2; // Scale to enhance image quality
  
        html2canvas(downloadSection[0], {
            scale: scale,
            useCORS: true
        }).then(function (canvas) {
            var imgData = canvas.toDataURL('image/png'); // Change 'image/png' to 'image/jpeg' for JPEG format
            var link = document.createElement('a');
            link.href = imgData;
            link.download = 'downloaded-content.png'; // Change the filename and extension as needed
            link.click();
        });
    });
  
    // Print HTML Document
    $('.print_btn').on('click', function () {
        window.print();
    });
  
  })(jQuery);
  

  // Print HTML Document
  $('.print_btn').on('click', function () {
      window.print();
  });

})(jQuery);
