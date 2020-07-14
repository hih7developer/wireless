<?php include('inc/header.php') ?>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="editModalLabel">Edit Modal</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form id="edit_form" action="" method='post'>
                  <div class="card-body register" >
                     <div class="form-group">
                        <label for="name"> Name</label>
                        <input type="text" name="user[name]" id="edit_name" value="" class="form-control" placeholder="Name">
                     </div>
                     <div class="form-group">
                        <label for="name">Email</label>
                        <input type="text" name="user[email]" id="edit_email" value="" class="form-control" placeholder="Email">
                     </div>
                     <input type="hidden" name="id" id="edit_id">
                     <div class="form-group">
                        <button class="btn btn-block btn-primary">Edit</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>