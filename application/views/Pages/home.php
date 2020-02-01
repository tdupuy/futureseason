
    <main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron header-block">
        <div class="container">
          <center><h2 class="display-3 page-title">{heading}</h2></center>
        </div>
      </div>



   <main role="main">
	 <div class="container">
        <!-- Example row of columns -->
        <div class="row mt-5">
          {series}
          <div class="card card-custom mx-2 mb-3" style="width: 18rem;">
            <img class="card-img-top" src="{img_path}" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">{name}</h5>
              <p class="card-text">{overview}</p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">{production}</li>
              <li class="list-group-item">{current_season}</li>
              <li class="list-group-item">{type}</li>
            </ul>
            <div class="card-body">
              <a href="#" class="btn btn-primary">Suivre</a>
            </div>
          </div>
          {/series}
        </div>
		    <hr>

    </main>
