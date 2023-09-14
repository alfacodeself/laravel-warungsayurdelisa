<script src="{{ asset('assets/landingpage/bootstrap/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/landingpage/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/landingpage/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/landingpage/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

{{-- PWA --}}
<script src="{{ asset('/sw.js') }}"></script>
<script>
   if ("serviceWorker" in navigator) {
      // Register a service worker hosted at the root of the
      // site using the default scope.
      navigator.serviceWorker.register("/sw.js").then(
      (registration) => {
         console.log("Service worker registration succeeded:", registration);
      },
      (error) => {
         console.error(`Service worker registration failed: ${error}`);
      },
    );
  } else {
     console.error("Service workers are not supported.");
  }
</script>

@include('landingpage.scripts.sweetalert2')
@stack('jslp')