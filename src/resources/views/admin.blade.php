@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection

@section('content')
<div class="section__title">
    <h2>Admin</h2>
</div>
<div class="search__content">
    <form class="search-form" action="/todos/search" method="GET">
        @csrf
        <div class="search-form__item">
            <input class="search-form__item-input" type="text" name="keyword" value="{{ old('keyword') }}">
            <select class="search-form__item-select" name="category_id">
                <option value="">カテゴリ</option>
                @foreach ($categories as $category)
                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="search-form__button">
            <button class="search-form__button-submit" type="submit">検索</button>
        </div>
        <div class="reset-form__button">
            <button class="reset-form__button-submit" type="submit">リセット</button>
        </div>
    </form>
</div>
<div class="contact__content">
    <div class="contact-table">
        <table class="contact-table__inner">
            <tr class="contact-table__row">
                <th class="contact-table__header">
                    <span class="contact-table__header-span">お名前</span>
                    <span class="contact-table__header-span">性別</span>
                    <span class="contact-table__header-span">メールアドレス</span>
                    <span class="contact-table__header-span">お問い合わせの種類</span>
                </th>
            </tr>
            @foreach ($contacts as $contact)
            <tr class="contact-table__row">
                <td class="contact-table__item">
                    <!-- <form class="update-form" action="/todos/update" method="POST">ここ直す -->
                    @method('PATCH')
                    @csrf
                    <div class="contact-table__item">
                        <!-- {{ dd($contact) }} -->
                        <p class="contact-table__item-p">{{ $contact['last_name'] . '　' . $contact['first_name'] }}</p>
                    </div>
                    <div class="contact-table__item">
                        <p class="contact-table__item-p">{{ $contact['gender'] }}</p>
                    </div>
                    <div class="contact-table__item">
                        <p class="contact-table__item-p">{{ $contact['email'] }}</p>
                    </div>
                    <div class="contact-table__item">
                        <!-- <input class="update-form__item-input" type="text" name="content" value="{{ $contact['content'] }}">
                        <input type="hidden" name="id" value="{{ $contact['id'] }}"> -->
                        <p class="contact-table__item-p">{{ $contact['category']['content'] }}</p>
                    </div>
                    <div class="contact-table__button">
                        <button class="contact-table__button-submit" type="submit">詳細</button>
                    </div>
                    <!-- </form> -->
                </td>
                <td class="contact-table__item">
                    <form class="delete-form" action="/todos/delete" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="delete-form__button">
                            <input type="hidden" name="id" value="{{ $todo['id'] }}">
                            <button class="delete-form__button-submit" type="submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection