<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Kost Griya Kenyo</title>
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  
  @include('includes.main.style')
  @include('includes.main.styledetail');
</head>
@include('includes.main.navbar')
  <main class="site-main">
    <div class="page-content page-details">
      <section class="kost-breadcrumbs">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                  </li>
                  <li class="breadcrumb-item active">
                    Kost Details
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>
    </div>
   </main>
