<!-- Modal -->
<div class="modal fade" id="signModal" tabindex="-1" role="dialog" aria-labelledby="signModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="signModalLabel">Create New account for IT-forum</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
            </button>
         </div>
         
         <div class="modal-body">
            <form action="/MyProjects/forumProject/partials/_sinupHandle.php" method="POST">
               <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" required class="form-control" id="exampleInputEmail1" name="Email" aria-describedby="emailHelp">
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
               </div>
  
               <div class="form-group">
                  <label for="username">username</label>
                  <input type="text" required class="form-control" id="exampleInputEmail1" name="username" aria-describedby="emailHelp">
                  <small id="emailHelp" class="form-text text-muted">Try to type unique username.</small>
               </div>
  
               <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" required class="form-control" id="exampleInputPassword1" name="pass">
               </div>
  
  
               <div class="form-group">
                  <label for="exampleInputPassword2">confirm password</label>
                  <input type="password" required class="form-control" id="exampleInputPassword2" name="cpass">
               </div>
 
               <button type="submit" class="btn btn-primary">signUp</button>
          
            </form>
         </div>
   
      </div>
   </div>
</div>