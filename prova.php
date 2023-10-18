<html>
<head>
	<title>PC Zone Prova search bar</title>
	<meta name="viewport" content="width-device-width, initial-scale=1"/>

	<link rel="stylesheet" type="text/css" href= "./Css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="./Css/prova.css" />

	<link rel="stylesheet" href="./fontawesome-free-5.13.0-web/css/all.css">

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js"></script>
  <script src="./Js/prova.js"> </script>
</style>
</head>
<body>
  <div class="container my-5">
    <form action="controller" method="get" class="d-md-flex d-sm-block justify-content-between">
      <input type="hidden" name="command" value="select-orders">
      <h1 class="h5 align-self-center col-3">Search Order</h1>
      <div class="btn-group align-self-center col-12 col-sm-12 col-md-8 col-lg-6">
        <select name="searchType" class="btn btn-outline-dark col-3 col-sm-3">
          <option value="orderId">Order ID</option>
          <option value="created">Created</option>
          <option value="customer">Customer</option>
          <option value="status">Status</option>
        </select>
        <input type="search" name="searchBy" class="col-6 col-sm-6">
        <input type="submit" value="Search" class="btn btn-outline-dark col-3 col-sm-3">
      </div>
    </form>
    <div class="row justify-content-md-between align-content-center border-bottom border-2 my-2 bg-dark text-light p-3 rounded-3">
      <div class="col-2 text-sm-center align-self-center">
        <h1 class="h5 fw-bold">Numero ordine</h1>
      </div>
      <div class="col-2 text-sm-center align-self-center">
        <h1 class="h5 fw-bold">Prezzo</h1>
      </div>
      <div class="col-3 text-sm-center align-self-center">
        <h1 class="h5 fw-bold">Totale pezzi</h1>
      </div>
      <div class="col-2 text-sm-center align-self-center">
        <h1 class="h5 fw-bold">Stato</h1>
      </div>
      <div class="col-2 text-sm-center align-self-center">
        <h1 class="h5 fw-bold">Mostra dettagli</h1>
      </div>
    </div>
    <div class="row justify-content-md-between border-bottom border-2 my-2 bg-light p-2 rounded-3">
      <div class="col-md-2 text-sm-center align-self-center my-2">
        <h1 class="h6">2F456DA</h1>
      </div>
      <div class="col-md-2 text-sm-center align-self-center my-2">
        <h1 class="h6">300$</h1>
      </div>
      <div class="col-md-3 text-sm-center align-self-center my-2">
        <h1 class="h6">10</h1>
      </div>
      <div class="col-md-2 text-sm-center align-self-center my-2">
        <h1 class="h6">Creato</h1>
      </div>
      <div class="col-md-2 text-sm-center align-self-center my-2">
        <a class="btn btn-outline-dark w-100" href="#">Dettagli</a>
      </div>
    </div>
    <div class="d-md-flex d-sm-block justify-content-md-between justify-content-sm-center text-center border-bottom border-2 my-2 bg-light p-2 rounded-3">
      <div class="col-md-2 text-sm-center text-md-start align-self-center my-2">
        <h1 class="h6">D2903WE</h1>
      </div>
      <div class="col-md-2 text-sm-center text-md-start align-self-center my-2">
        <h1 class="h6">03/09/2021 3:15:24:299</h1>
      </div>
      <div class="col-md-3 text-sm-center text-md-start align-self-center my-2">
        <h1 class="h6">Jason Tailor Hamonovych</h1>
      </div>
      <div class="col-md-2 text-sm-center text-md-start align-self-center my-2">
        <a class="btn btn-outline-dark w-100" href="#">Details</a>
      </div> <div class="col-md-2 text-sm-center text-md-start align-self-center my-2">
        <form method="get" action="controller" class="d-flex btn-group">
          <input type="hidden" name="command" value="refresh-order-status">
          <select name="status" class="btn btn-outline-dark">
            <option value="REGISTERED" class="form-select-button">REGISTERED</option>
            <option value="PAID" class="form-select-button">PAID</option>
            <option value="CANCELED" class="form-select-button">CANCELED</option>
          </select>
        </form>
      </div>
    </div>
</div>
</body>
</html>