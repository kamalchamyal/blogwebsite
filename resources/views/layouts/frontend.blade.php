<!DOCTYPE html>
<html lang="en">
  @include('frontend.head')
<body>

    <div id="main-wrapper">

    <section>
        @include('frontend.header')
    </section>


    @yield('content')

    <section>
        @include('frontend.footer')
    </section>
</div>
    @include('frontend.fscript')

</body>
</html>
