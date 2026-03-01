@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection

@section('button')
<nav>
    <ul class="header-nav">
        <li class="header-nav__item">
            <form class="header-nav__link" action="/logout" method="post">
                @csrf
                <button type="submit">logout</button>
            </form>
        </li>
    </ul>
</nav>
@endsection

@section('content')
<div class="section__title">
    <h2>Admin</h2>
</div>
<div class="search__content">
    <form class="search-form" action="/search" method="GET">
        @csrf
        <div class="search-form__item">
            <input class="search-form__item-input" type="text" name="keyword" value="{{ request('keyword') }}">
            <select class="search-form__item-select" name="gender" value="{{ request('gender') }}">
                <option value="" selected>性別</option>
                <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>全て</option>
                <option value="1" {{ request('gender') == 1 ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == 2 ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == 3 ? 'selected' : '' }}>その他</option>
            </select>
            <select class="search-form__item-select" name="category_id">
                <option value="">お問い合わせの種類</option>
                @foreach ($categories as $category)
                <option value="{{ $category['id'] }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category['content'] }}</option>
                @endforeach
            </select>
            <input type="date" name="date" class="search-form__item-input" value="{{ request('date') }}">
        </div>
        <div class="search-form__button">
            <button class="search-form__button-submit" type="submit" name='action' value="submit">検索</button>
        </div>
        <div class="reset-form__button">
            <button class="reset-form__button-submit" type="submit" name='action' value="reset">リセット</button>
        </div>
    </form>
</div>
<div class="search__content">
    <div class="search-form">
        <div class="search-form__item">
            <div class="search-form__button">
                <button class="search-form__button-submit" type="submit">エクスポート</button>
            </div>
        </div>
        <div class="search-form__item">
            <div class="search-form__button">
                {{ $contacts->links() }}
            </div>
        </div>
    </div>
</div>
<div class="contact__content">
    <div class="contact-table">
        <table class="contact-table__inner">
            <tr class="contact-table__row">
                <th class="contact-table__header">
                    <span class="contact-table__header-span">お名前</span>
                </th>
                <th class="contact-table__header">
                    <span class="contact-table__header-span">性別</span>
                </th>
                <th class="contact-table__header">
                    <span class="contact-table__header-span">メールアドレス</span>
                </th>
                <th class="contact-table__header">
                    <span class="contact-table__header-span">お問い合わせの種類</span>
                </th>
                <th class="contact-table__header">
                    <span class="contact-table__header-span"></span>
                </th>
            </tr>
            @if($contacts->isNotEmpty())
            @foreach ($contacts as $contact)
            <tr class="contact-table__row">
                <td class="contact-table__item">
                    <p class="contact-table__item-p">{{ $contact['last_name'] . '　' . $contact['first_name'] }}</p>
                </td>
                <td class="contact-table__item">
                    <input type="hidden" value="{{ $contact['gender'] }}">
                    <p class="contact-table__item-p">
                        <?php
                        if ($contact['gender'] == '1') {
                            echo '男性';
                        } elseif ($contact['gender'] == '2') {
                            echo '女性';
                        } else {
                            echo 'その他';
                        }
                        ?>
                    </p>
                </td>
                <td class=" contact-table__item">
                    <p class="contact-table__item-p">{{ $contact['email'] }}</p>
                </td>
                <td class="contact-table__item">
                    <p class="contact-table__item-p">{{ $contact['category']['content'] }}</p>
                </td>
                <td class="contact-table__item">
                    <p class="contact-table__item-p" wire:click="openModal({{ $contact['id'] }})">詳細</p>
                </td>
            </tr>
            @endforeach
            @else
            <tr class="contact-table__row">該当するデータはありませんでした</tr>
            @endif
        </table>
    </div>
</div>
@livewire('modal')
@endsection