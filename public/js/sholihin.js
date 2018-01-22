$(document).ready(function(){

  (function( $ ){

    $.fn.filemanager = function(type, options) {
      type = type || 'file';

      this.on('click', function(e) {
        var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
        localStorage.setItem('target_input', $(this).data('input'));
        localStorage.setItem('target_preview', $(this).data('preview'));
        window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
        window.SetUrl = function (url, file_path) {
            //set the value of the desired input to image url
            var target_input = $('#' + localStorage.getItem('target_input'));
            target_input.val(file_path).trigger('change');

            //set or change the preview image src
            var target_preview = $('#' + localStorage.getItem('target_preview'));
            target_preview.attr('src', url).trigger('change');
        };
        return false;
      });
    }

  })(jQuery);

  $('#lfm1').filemanager('image');

  var harga = parseInt($(this).find('#rupiah').text(), 10);
  var gg = 20 * harga;
  var val = (gg/1).toFixed(2).replace('.', ',');
  var hasil = val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  $("#total-harga").text(hasil);

    $("#beli").change(function(){
        var foo = $("#beli").val();
        var bar = foo * harga;
        var baz = (bar/1).toFixed(2).replace('.', ',');
        var output = baz.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        $("#total-harga").text(output);
    });

  var harga = parseInt($(this).find('#rupiah').text(), 10);
  var yy = harga;
  var cok = (yy/1).toFixed(2).replace('.', ',');
  var mantap = cok.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  $("#rupiah").text(mantap);
});
