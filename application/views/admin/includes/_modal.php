<div class="modal fade" id="<?= $modal['id'];?>" tabindex="-1" role="dialog" aria-labelledby="<?= $modal['id'];?>Label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="<?= $modal['id'];?>Label"><?= $modal['title'];?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!--button type="button" class="btn btn-primary">Save changes</button-->
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){


     $.ajax({
            type: 'GET',
            url:'<?= $modal['src'];?>',
            data: { },
            success:function(response) {
                $( "#<?= $modal['id'];?> .modal-body" ).html(response);
            }
        });

     <?php if ( $modal['refresh']==true ) : ?>
       $('#<?= $modal['id'];?>').on('hidden.bs.modal', function () { 
            location.reload();
        });
     <?php endif; ?>
     
});


/*alert("cc");
$('#topup').modal("show");
$('#topup').modal("toggle");
alert("dd");
*/
/*
$('#<?= $modal['id'];?>').on('show.bs.modal', function (event) {
  

  var button = $(event.relatedTarget) // Button that triggered the modal
  var key = button.data('shipment_id') // Extract info from data-* attributes
  alert('key');
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})


/*  $.ajax({
            type: 'GET',
            url:'<?= $modal['src'];?>',
            data: { },
            success:function(response) {
                $( "#<?= $modal['id'];?> .modal-body" ).html(response);
            }
        });
*/

</script>