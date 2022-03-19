@extends('homepage')

@section('contents')
<main>
    <article>
    <h2>What is ACME?</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore asperiores neque perferendis aliquam similique reprehenderit? Repellat consequuntur sapiente facilis recusandae, ut voluptas ab consequatur dolore eligendi iure, dolorem quia soluta?
     Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur saepe quia tenetur harum consequatur? Enim voluptatem culpa minus, nemo distinctio optio quaerat exercitationem facere quos et impedit consequatur odit aspernatur?
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptate id, dolor incidunt magnam maiores labore optio blanditiis ut deserunt a quaerat accusamus inventore mollitia eum ullam voluptates delectus animi placeat!</p>
    </article>
    <ul class="photos">
        <li> <img src="/img/photo1.jpg" alt="pet clinic"></li>
        <li> <img src="/img/photo2.jpg" alt="pet grooming"></li>
    </ul>
    </main>
    <section class="about">
        <h2>About Us</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore asperiores neque perferendis aliquam similique reprehenderit? Repellat consequuntur sapiente facilis recusandae, ut voluptas ab consequatur dolore eligendi iure, dolorem quia soluta?<br>
     Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur saepe quia tenetur harum consequatur? Enim voluptatem culpa minus, nemo distinctio optio quaerat exercitationem facere quos et impedit consequatur odit aspernatur?<br>
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptate id, dolor incidunt magnam maiores labore optio blanditiis ut deserunt a quaerat accusamus inventore mollitia eum ullam voluptates delectus animi placeat!</p>
    <form>
        <input type="email" name="email" placeholder="Please type your email">
    </form>
    </section>
    <footer>
        <p class="copyright">Copyright 2022 ACME</p>
    </footer>
@endsection