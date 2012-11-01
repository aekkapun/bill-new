<div style="display: none;" class="modal" id="modal_window" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 id="modal_header"></h4>
    </div>


    <!-- Modal body -->
    <div class="modal-body" id="modal_body">

        <!-- Error contaier -->
        <div class="alert" id="flash_container" style="display: none;"></div>

        <!-- Form -->
        <?php $this->render('_form', array('model' => $model)); ?>

    </div>


    <!-- Modal footer -->
    <div class="modal-footer">
        <input type="submit" class="btn" id="submit" />
    </div>


</div>


<script>
    /**
     * Input buttons
     */
    $('.static-input-button').bind('click', function(){

        var data = {
            siteId     : $(this).data('site-id'),
            indexId    : $(this).data('index-id'),
            indexTitle : $(this).data('index-title')
        };

        $('#modal_header').text( data.indexTitle );
        $('#StaticIndexInput_site_id').val( data.siteId );
        $('#StaticIndexInput_static_index_id').val( data.indexId );

    });



    /**
     * Submit button
     */
    $('#submit').bind('click', function(){

        var modal = $('#modal_window');

        var form = {
            action : '/admin/staticIndex/staticIndexInput/create',
            data : $('#static-index-input-form').serialize()
        }

        var dataTable = $('#static-index-grid');
        dataTable.update = function( indexName ){

            $.get();

            var row = {
                inputDate    : $(this).find( 'tr.' + indexName + ' td.inputDate' ),
                currentValue : $(this).find( 'tr.' + indexName + ' td.currentValue' ),
                lastValue    : $(this).find( 'tr.' + indexName + ' td.lastValue' )
            }
        }



        $.post(
            form.action,
            form.data
        )
        .success(function(data){
            var response = $.parseJSON( data );

            if( response.status == 'success' )
            {
                modal.modal('hide');
                dataTable.update( response.indexName );
            }
            else
            {
                $('#flash_container')
                .html( response.data )
                .addClass( 'alert-' + response.status)
                .slideDown(300);
            }
        });

    });
</script>