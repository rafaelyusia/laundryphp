   <!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Login Page</title>
      <link href="public/tailwind.css" rel="stylesheet">
      </head>
   <body class="bg-white">
      <div class="flex items-center justify-center min-h-screen">
         <div class="w-[400px]">
               <div class="card-body">
                  <div class="flex justify-center mb-3">
                     <img src="assets/img/logovslaundry.PNG" class="w-[150px]">
                  </div>
                  <form action="login.php" method="POST">
                     <div class="form-control">
                           <input type="text" name="username" placeholder="Username" class="input input-bordered">
                     </div>

                     <div class="form-control mt-4">
                           <input type="password" name="password" placeholder="Password" class="input input-bordered">
                     </div>

                     <div class="form-control mt-6">
                           <button type="submit" class="btn btn-primary">Login</button>
                     </div>

                     <h5 class="text-center mt-4 text-slate-500">
                        Made with love by Rafael Yusia 
                     </h5>
                  </form>
               </div>
      </div>
   </body>
   </html>
