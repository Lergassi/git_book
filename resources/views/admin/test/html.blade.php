@extends("layouts.main")

@section("content")
    <div class="block">
        <div class="block__title">Кнопки</div>
        <div class="block__content">
            <a class="btn" href="">Default</a>
            <a class="btn btn_primary" href="">Primary</a>
            <a class="btn btn_success" href="">Success</a>
            <a class="btn btn_info" href="">Info</a>
            <a class="btn btn_danger" href="">Danger</a>
            <a class="btn btn_warning" href="">Warning</a>
            <input class="btn btn_danger" type="submit" name="book[delete]" value="Удалить">
            <input class="btn btn_primary" type="submit" name="book[delete]" value="Удалить">
            <a class="btn btn_danger" href="">Danger</a>
            <a class="btn btn_warning" href="">Warning</a>
        </div>
    </div>
@endsection