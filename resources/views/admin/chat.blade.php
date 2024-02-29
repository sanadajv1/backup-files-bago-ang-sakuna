<!DOCTYPE html>
<html lang="en">
  <head>
   @include('admin.css')
   @livewireStyles
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
        <!-- partial:partials/_navbar.html -->
        @include('admin.header')
        <!-- partial -->
        <livewire:counter /> 
    <!-- container-scroller -->
    <!-- plugins:js -->
   @include('admin.script')
   @livewireScripts
    <!-- End custom js for this page -->
  </body>
</html>