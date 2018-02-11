    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
<?php if($page=="edit"){?>
    <script src="js/lite-editor.min.js"></script>
    <script>
    window.addEventListener('DOMContentLoaded',function(){
        var liteeditor = new LiteEditor('.js-lite-editor');
    });
    </script>
<?php }?>
    <script>
    $(document).ready(function(){
      $('.viewModal').on('click',function(e){
        e.preventDefault();
        var dataURL = $(this).attr('data-remote');
        $('.modal-content').load(dataURL,function(){
            $('#viewModal').modal({show:true});
        });
      });
      $('.btn-delete').on('click',function(e){
        e.preventDefault();
        var dataID = $(this).attr('data-id');
        $.ajax({
          type: "POST",
          url: "includes/delete.php",
          data: 'id='+dataID,
          success: function() {
          $('#item_'+dataID).fadeOut(500, function() {
            $('#item_'+dataID).remove();
          });
        }
        });
      });
    });
    </script>
    <div id="viewModal" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        </div>
      </div>
    </div>
  </body>
</html>
