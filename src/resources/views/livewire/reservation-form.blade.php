<div class="reservation-summary">
    <p class="reservation-summary__item reservation-summary__date">
        <input type="date" id="reservation_date" name="reservation_date" class="item" wire:model="reservation_date" min="{{ \Carbon\Carbon::now()->addDay()->format('Y-m-d') }}" placeholder="年/月/日" required>
        @error('reservation_date')
                <p style="color: yellow; font-weight: bold; margin-left:50px;">{{ $message }}</p>
        @enderror
    </p>
    <p class="reservation-summary__item">
        <select id="reservation_time" name="reservation_time" class="item" wire:model="reservation_time" required>
            <option value="" disabled selected>予約時間</option>
            @for ($i = 9; $i <= 21; $i++)
            @foreach(['00', '30'] as $minute)
                <option value="{{ sprintf('%02d:%s', $i, $minute) }}">{{ sprintf('%02d:%s', $i, $minute) }}</option>
            @endforeach
        @endfor
        </select>
        @error('reservation_time')
                <p style="color: yellow; font-weight: bold; margin-left:50px;">{{ $message }}</p>
        @enderror
    </p>
    <p class="reservation-summary__item">
        <select id="guest_count" name="guest_count" class="item" wire:model="guest_count" required>
            <option value="" disabled selected>人数</option>
            @for ($i = 1; $i <= 10; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        @error('guest_count')
                <p style="color: yellow; font-weight: bold; margin-left:50px;">{{ $message }}</p>
        @enderror
    </p>
    <p class="reservation-summary__item">
        <select id="menu" name="menu" class="item" wire:model="menu">
            <option value="" disabled selected>メニュー</option>
            <option value="松">松</option>
            <option value="竹">竹</option>
            <option value="梅">梅</option>
        </select>
    </p>

    <div class="reservation-check">
        <p class="reservation-check__item">Shop&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $restaurant->restaurant_name }}</p>
        <p class="reservation-check__item">Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $reservation_date }}</p>
        <p class="reservation-check__item">Time&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $reservation_time }}</p>
        <p class="reservation-check__item">Number&nbsp;&nbsp;&nbsp;&nbsp;{{ $guest_count }}人</p>
        <p class="reservation-check__item">Menu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $menu ?? '未選択' }}</p>
    </div>

</div>
