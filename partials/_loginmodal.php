<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="loginModalLabel">login your account</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       
       <div class="modal-body">
         <form action="/MyProjects/forumProject/partials/_loginHandle.php" method="POST">
           
            <div class="form-group">
               <label for="Email1">Email address</label>
               <input type="email" class="form-control" id="Email1" name="Email1" aria-describedby="emailHelp">
               <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
   
            <div class="form-group">
               <label for="Password1">Password</label>
               <input type="password" class="form-control" id="Password1" name="Password1">
            </div>
 
            <button type="submit" class="btn btn-primary">login</button>
    
         </form>
       </div>
   
    </div>
  </div>
</div>