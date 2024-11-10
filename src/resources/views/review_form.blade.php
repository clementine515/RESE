@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review_form.css') }}">
@endsection

@section('menu-btn')
<input type="checkbox" id="overlay-input" />
<label for="overlay-input" id="overlay-button">__</br>____</br>_</label>
<div id="overlay">
    <label for="overlay-input" id="close-button">&times;</label>
    <ul>
        <li><a href="/toppage_logged_in">Home</a></li>
        <li>
            <form action="/logout" method="post">
                @csrf
                <button class="header-nav__button">Logout</button>
            </form>
        </li>
        <li><a href="/mypage">Mypage</a></li>
    </ul>
</div>
@endsection('menu-btn')

@section('content')
<div class="review-form">
    <div class="review-restaurant">
        <h1 class="title">今回のご利用はいかがでしたか？</h1>
        <div class="card">
            <img src="{{ Storage::url($restaurant->photo_url) }}" class="card-img-top" alt="{{ $restaurant->restaurant_name }}">
            <div class="card-body">
                <div class="card-title">{{ $restaurant->restaurant_name }}</div>
                <p class="card-text">
                    ＃{{ $restaurant->area->area_name }}
                    ＃{{ $restaurant->genre->genre_name }}
                </p>
                <a href="{{ route('shop_detail', ['shop_id' => $restaurant->id]) }}" class="btn-primary">詳しく見る</a>
            </div>
        </div>
    </div>
    <div class="review-make">
        <form action="{{ isset($review) ? route('review.update', ['id' => $review->id]) : route('reviews.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($review))
                @method('PUT')
            @endif

            <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">

            <h3>体験を評価してください</h3>
            <div class="star-rating">
                @for ($i = 1; $i <= 5; $i++)
                    <input type="radio" id="star{{ $i }}-{{ $restaurant->id }}" name="star" value="{{ $i }}"
                {{ isset($review) && $review->star == $i ? 'checked' : '' }} />
                    <label for="star{{ $i }}-{{ $restaurant->id }}" class="star">&#9733;</label>
                @endfor
            </div>

            <h3 class="review">口コミを投稿</h3>
            <textarea class="review-comment" maxlength="400" name="comment" placeholder="カジュアルな夜のお出かけにおすすめのスポット" oninput="updateCharacterCount(this)">{{ old('comment', isset($review) ? $review->comment : '') }}</textarea>
            @error('comment')
                <div class="error-message" style="color: red;">{{ $message }}</div>
            @enderror
            <p class="review-text"><span id="charCount">0</span>/400（最高文字数）</p>

            <script>
            function updateCharacterCount(textarea) {
                const maxLength = 400;
                const currentLength = textarea.value.length;
                document.getElementById('charCount').textContent = currentLength;
            }
            </script>

            <h3 class="review">画像の追加</h3>
            <div class="upload-box" id="uploadBox">
                <input type="file" name="photo">
            </div>
            @if ($errors->has('photo'))
                <p class="error-message" style="color: red;">* jpegまたはpng形式のみアップロード可能です。 </p>
            @endif

            <button type="submit" class="btn-submit">口コミを投稿</button>

            <!-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                const uploadBox = document.getElementById('uploadBox');
                const fileInput = document.getElementById('fileInput');
                const errorMessage = document.getElementById('errorMessage');

                uploadBox.addEventListener('click', () => {
                    fileInput.click();
                });

                fileInput.addEventListener('change', handleFile);

                uploadBox.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    uploadBox.classList.add('drag-over');
                });

                uploadBox.addEventListener('dragleave', () => {
                    uploadBox.classList.remove('drag-over');
                });

                uploadBox.addEventListener('drop', (e) => {
                    e.preventDefault();
                    uploadBox.classList.remove('drag-over');
                    const files = e.dataTransfer.files;
                    if (files.length) {
                        fileInput.files = files;
                        handleFile();
                    }
                });

                function handleFile() {
                    const file = fileInput.files[0];
                    if (file && (file.type === 'image/jpeg' || file.type === 'image/png')) {
                        errorMessage.style.display = 'none';
                        uploadBox.innerHTML = `<p>${file.name} が選択されました</p>`;
                    } else {
                        fileInput.value = '';
                        errorMessage.style.display = 'block';
                        uploadBox.innerHTML = `<p>クリックして写真を追加 またはドラッグ&ドロップ</p>`;
                    }
                }
            });
            </script> -->
        </form>
    </div>
</div>
@endsection('content')
