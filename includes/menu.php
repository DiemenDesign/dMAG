<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="?page=index">diemenMAG</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item<?php if($page=='catalog')echo' active';?>">
        <a class="nav-link" href="?page=catalog">Catalog</a>
      </li>
      <li class="nav-item<?php if($page=='edit')echo' active';?>">
        <a class="nav-link" href="?page=edit&id=0">Add</a>
      </li>
      <li class="nav-item<?php if($page=='about')echo' active';?>">
        <a class="nav-link" href="?page=about">About</a>
      </li>
    </ul>
    <form class="form-inline" method="post" action="?page=catalog">
      <div class="input-group">
        <input class="form-control form-control-sm" type="text" name="search" value="<?php if(isset($_POST['search']))echo$_POST['search'];?>" placeholder="Search...">
        <div class="input-group-append">
          <button class="btn btn-secondary btn-sm" type="submit">Search</button>
        </div>
      </div>
    </form>
  </div>
</nav>
