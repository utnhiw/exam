@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection

@section('button')
<nav>
    <ul class="header-nav">
        <li class="header-nav__item">
            <a class="header-nav__link" href="/logout">
                logout
            </a>
        </li>
    </ul>
</nav>
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
        {{ $contacts->links() }}
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
                    <p class="contact-table__item-p">{{ $contact['last_name'] . '　' . $contact['first_name'] }}</p>
                </td>
                <td>
                    <p class="contact-table__item-p">{{ $contact['gender'] }}</p>
                </td>
                <td class="contact-table__item">
                    <p class="contact-table__item-p">{{ $contact['email'] }}</p>
                </td>
                <td class="contact-table__item">
                    <p class="contact-table__item-p">{{ $contact['category']['content'] }}</p>
                </td>
                <td class="contact-table__item">
                    <p wire:click="openModal({{ $contact['id'] }})" class="contact-table__button cursor-pointer hover:bg-gray-100">詳細</p>
                </td>
                @if($showModal && $selectedContact)
                <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                    <div class="bg-white p-6 rounded shadow-lg max-w-md w-full">
                        <button wire:click="closeModal" class="close__button">
                            ×
                        </button>
                        <form class="detail-form" action="/todos/delete" method="POST">
                            @method('DELETE')
                            @csrf
                            <div class="confirm-table">
                                <table class="confirm-table__inner">
                                    <tr class="confirm-table__row">
                                        <th class="confirm-table__header">お名前</th>
                                        <td class="confirm-table__text">
                                            <input type="text" name="name" value="{{ $selectedContact['last_name'] . '　' . $selectedContact['first_name'] }}" readonly />
                                        </td>
                                    </tr>
                                    <tr class="confirm-table__row">
                                        <th class="confirm-table__header">性別</th>
                                        <td class="confirm-table__text">
                                            <input type="text" name="gender" value="{{ $selectedContact['gender'] }}" readonly />
                                        </td>
                                    </tr>
                                    <tr class="confirm-table__row">
                                        <th class="confirm-table__header">メールアドレス</th>
                                        <td class="confirm-table__text">
                                            <input type="email" name="email" value="{{ $selectedContact['email'] }}" readonly />
                                        </td>
                                    </tr>
                                    <tr class="confirm-table__row">
                                        <th class="confirm-table__header">電話番号</th>
                                        <td class="confirm-table__text">
                                            <input type="tel" name="tel" value="{{ $selectedContact['tel'] }}" readonly />
                                        </td>
                                    </tr>
                                    <tr class="confirm-table__row">
                                        <th class="confirm-table__header">住所</th>
                                        <td class="confirm-table__text">
                                            <input type="text" name="address" value="{{ $selectedContact['address'] }}" readonly />
                                        </td>
                                    </tr>
                                    <tr class="confirm-table__row">
                                        <th class="confirm-table__header">建物名</th>
                                        <td class="confirm-table__text">
                                            <input type="text" name="building" value="{{ $selectedContact['building'] }}" readonly />
                                        </td>
                                    </tr>
                                    <tr class="confirm-table__row">
                                        <th class="confirm-table__header">お問い合わせの種類</th>
                                        <td class="confirm-table__text">
                                            <input type="text" name="category_id" value="{{ $selectedContact['category_id'] }} {{ $category['content'] }}" readonly />
                                        </td>
                                    </tr>
                                    <tr class="confirm-table__row">
                                        <th class="confirm-table__header">お問い合わせ内容</th>
                                        <td class="confirm-table__text">
                                            <input type="text" name="content" value="{{ $selectedContact['content'] }}" readonly />
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="delete-form__button">
                                <input type="hidden" name="id" value="{{ $selectedContact['id'] }}">
                                <button class="delete-form__button-submit" type="submit">削除</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection