
    <main role="main">
      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron header-block">
        <div class="container">
          <center><h2 class="display-3 page-title">{heading}</h2></center>
        </div>
      </div>
      <?php if(isset($this->session->user['id']) && !empty($this->session->user['id'])): ?>
	     <div id="cat-1" class="container py-5">
         <h1> Mes dernières séries suivies </h1>
         <div class="row mt-5 ml-5 "><!--d-flex flex-row flex-nowrap-->
           <div class="owl-carousel owl-theme">
              <?php foreach($followed_series as $follow_serie) : ?>
              <div class="card card-custom mx-2 mb-3" style="width: 18rem;">
                <img class="card-img-top" src="<?php echo $follow_serie->img_path ?>" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $follow_serie->name ?></h5>
                  <p class="card-text overview"><?php echo $follow_serie->overview ?></p>
                  <a class="card-text read-more"> Afficher plus ...</a>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><?php echo $follow_serie->production ?></li>
                  <li class="list-group-item"><?php echo $follow_serie->current_season ?></li>
                  <li class="list-group-item"><?php echo $follow_serie->type ?></li>
                </ul>
                <div class="card-body">
                    <?php if(isset($this->session->user['id']) && !empty($this->session->user['id'])) : ?>
                      <a href="<?php echo base_url('Pages/follow_serie').'/'.$this->session->user['id'].'/{id}/true'; ?>" data-id="{id}" class="btn btn-success unfollow">Suivie</a>
                    <?php else : ?>
                      <small> Tu dois te connecter pour suivre tes séries préférées ! </small>
                    <?php endif; ?>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      <?php endif;?>
        <div id="cat-2" class="container py-5">
          <h1> A la mode </h1>
          <div class="row mt-5 ml-5 "><!--d-flex flex-row flex-nowrap-->
            <div class="owl-carousel owl-theme">
               <?php foreach($trending_series as $trending_serie) : ?>
                <div class="card card-custom mx-2 mb-3" style="width: 18rem;">
                  <img class="card-img-top" src="<?php echo $trending_serie->img_path ?>" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $trending_serie->name ?></h5>
                    <p class="card-text overview"><?php echo $trending_serie->overview ?></p>
                    <a class="card-text read-more"> Afficher plus ...</a>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item"><?php echo $trending_serie->production ?></li>
                    <li class="list-group-item"><?php echo $trending_serie->current_season ?></li>
                    <li class="list-group-item"><?php echo $trending_serie->type ?></li>
                  </ul>
                 <div class="card-body">
                    <?php if(isset($this->session->user['id']) && !empty($this->session->user['id'])) : ?>
                      <a href="#" data-id="{id}" class="btn btn-primary follow">Suivre</a>
                    <?php else : ?>
                      <small> Tu dois te connecter pour suivre tes séries préférées ! </small>
                    <?php endif; ?>
                 </div>
               </div>
               <?php endforeach; ?>
             </div>
           </div>
         </div>
         <div id="cat-2" class="container py-5">
           <h1> Pourrait vous intéresser </h1>
           <div class="row mt-5 ml-5 "><!--d-flex flex-row flex-nowrap-->
             <div class="owl-carousel owl-theme">
                <?php foreach($random_series as $random_serie) : ?>
                <div class="card card-custom mx-2 mb-3" style="width: 18rem;">
                  <img class="card-img-top" src="<?php echo $random_serie->img_path ?>" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $random_serie->name ?></h5>
                    <p class="card-text overview"><?php echo $random_serie->overview ?></p>
                    <a class="card-text read-more"> Afficher plus ...</a>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item"><?php echo $random_serie->production ?></li>
                    <li class="list-group-item"><?php echo $random_serie->current_season ?></li>
                    <li class="list-group-item"><?php echo $random_serie->type ?></li>
                  </ul>
                  <div class="card-body">
                    <?php if(isset($this->session->user['id']) && !empty($this->session->user['id'])) : ?>
                      <a href="#" data-id="{id}" class="btn btn-primary follow">Suivre</a>
                    <?php else : ?>
                      <small> Tu dois te connecter pour suivre tes séries préférées ! </small>
                    <?php endif; ?>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
		    <hr>
    </main>
    <script type="text/javascript">
      $(document).ready(function() {
        var owl = $('.owl-carousel');
        $('.read-more').click(function(){
          owl.trigger('stop.owl.autoplay');
          $(this).siblings('.overview').slideToggle(500,function(){
            if($(this).is(':visible'))
               $(this).siblings('.read-more').text('Afficher moins ...');
             else
               $(this).siblings('.read-more').text('Afficher plus ...');
          });
          // Stopper le slider et si click sur afficher moins ou hover out relancer le slider et replier le menu
        });
        $('.card-custom').mouseleave(function(){
          if($(this).find('.overview').is(':visible')){
            owl.trigger('play.owl.autoplay');
            $(this).find('.overview').slideUp(function(){
              $(this).siblings('.read-more').text('Afficher plus ...');
            });
          }
        });
        $('.follow,.unfollow').mouseover(function(){
          if($(this).hasClass('.unfollow')){
            $(this).removeClass('btn-primary').addClass('btn-danger');
          }
        });
        $('.follow').click(function(e){
          e.preventDefault();
          owl.trigger('stop.owl.autoplay');
          var elmt = $(this);
          $.ajax({
           url: elmt.attr('href'),
           type: "GET",
           // On récupère la réponse en JSON
           dataType: "json",
           success: function(data){
              if(data == true){
                console.log(elmt);
                elmt.removeClass('btn-primary').addClass('btn-success').text('Suivie');
              }else{
                alert('Déjà suivie espèce de nouille !');
              }
              owl.trigger('play.owl.autoplay');
           },
           error: function(data){
              console.log(data);
           }
          });
        });
      });
    </script>
