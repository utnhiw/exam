<div>
    @if($showModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded shadow-lg max-w-md w-full">
            <button wire:click="closeModal" class="close__button">
                ×
            </button>
            <div class="detail-table">
                <table class="detail-table__inner">
                    <tr class="detail-table__row">
                        <th class="detail-table__header">お名前</th>
                        <td class="detail-table__text">{{ $contact['last_name'] . '　' . $contact['first_name'] }}</td>
                    </tr>
                    <tr class="detail-table__row">
                        <th class="detail-table__header">性別</th>
                        <td class="detail-table__text">
                            <input type="hidden" value="{{ $contact['gender'] }}">
                            <?php
                            if ($contact['gender'] == '1') {
                                echo '男性';
                            } elseif ($contact['gender'] == '2') {
                                echo '女性';
                            } else {
                                echo 'その他';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr class="detail-table__row">
                        <th class="detail-table__header">メールアドレス</th>
                        <td class="detail-table__text">{{ $contact['email'] }}</td>
                    </tr>
                    <tr class="detail-table__row">
                        <th class="detail-table__header">電話番号</th>
                        <td class="detail-table__text">{{ $contact['tel'] }}</td>
                    </tr>
                    <tr class="detail-table__row">
                        <th class="detail-table__header">住所</th>
                        <td class="detail-table__text">{{ $contact['address'] }}</td>
                    </tr>
                    <tr class="detail-table__row">
                        <th class="detail-table__header">建物名</th>
                        <td class="detail-table__text">{{ $contact['building'] }}</td>
                    </tr>
                    <tr class="detail-table__row">
                        <th class="detail-table__header">お問い合わせの種類</th>
                        <td class="detail-table__text">{{ $contact['category']['content'] }}</td>
                    </tr>
                    <tr class="detail-table__row">
                        <th class="detail-table__header">お問い合わせ内容</th>
                        <td class="detail-table__text">{{ $contact['detail'] }}</td>
                    </tr>
                </table>
            </div>
            <form class="detail-form" action="/delete" method="POST">
                @method('DELETE')
                @csrf
                <div class="delete-form__button">
                    <input type="hidden" name="id" value="{{ $contact['id'] }}">
                    <button class="delete-form__button-submit" type="submit">削除</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>