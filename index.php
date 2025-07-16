<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Bookmark Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>
   <div class="container mt-5">
    <h1 class="text-center mb-4">Simple Bookmark Manager</h1>

      <!--Add Bookmark From-->
      <div class="card mb-4">
            <div class="card-body">
                    <h5 class="card-title">Add new Bookmark</h5>
                    <form action="server.php" method="POST" id="bookmarkForm">
                        <input type="hidden" name="action" value="add">
                        <div class="md-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class mb-3>
                            <label for="url" class="form-label">URL</label>
                            <input type="url" class="form-control" id="url" name="url" required>

                        </div>
                        <button type="submit" class="btn btn-primary">Add bookmarkForm</button>
                    </form>
            </div>
      </div>

      <!--Bookmark List-->
      <div id="bookmarkList">
        <h3 class="mb-3">My Bookmarks</h3>
        <div class="row" id="bookmarksContainer">
            <!--Bookmarks will be loaded via AJAX -->

        </div>
      </div>
   </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

     <script>
        //load bookmarks when page loaded
        document.addEventListener('DOMContentLoaded', function(){
            loadBookmarks();
        });

        //function to load bookmark Form server
        function loadBookmarks(){
            fetch('server.php?action=get')
            .then(response => response.json())
            .then(data =>{
                const container = document.getElementById('bookmarksContainer');
                container.innerHTML = '';

                if(data.length === 0){
                    container.innerHTML = '<p class="text-muted">No bookmarks yet.Add your bookmarks!!!</p>';
                }
                data.forEach(bookmark => {
                    const col = document.createElement('div');
                    col.className = 'col-md-4 mb-4';
                    col.innerHTML = `
                    <div class="card bookmark-card">
                    <div class="card-body">
                     <h5 class="card-title">${bookmark.title}</h5>
                     <a href = "${bookmark.ur}" target ="_blank" class="card-link">Visit</a>

                     <button class="btn btn-sm btn-danger float-end">Delete</button>
                    </div>
                    </div>
                    `;
                    container.appendChild(col);
                });
            });
        }
     </script>
</body>

</html>