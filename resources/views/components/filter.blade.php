@props(['searchOnly' => false])

<div class="row justify-content-start mb-3">
    <div class="col-lg-3">
        <input type="text" class="form-control" id="searchInput" placeholder="Search...">
    </div>
    @if (!$searchOnly)
    <div class="col-lg-3">
        <select id="filterSelect" class="form-control">
            <option value="">{{ $defaultLabel }}</option>
            @foreach($options as $option)
                <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
            @endforeach
        </select>
    </div>
    @endif
</div>

<script>
    let searchOnly = '';
    document.getElementById('searchInput').addEventListener('input', function () {
        applyFilters();
    });

    @if (!$searchOnly)
    document.getElementById('filterSelect').addEventListener('change', function () {
        applyFilters();
    });
    @endif

    function applyFilters() {
        var searchFilter = document.getElementById('searchInput').value.toLowerCase();
        var dropdownFilter = document.getElementById('filterSelect') ? document.getElementById('filterSelect').value.toLowerCase() : '';
        var rows = document.querySelectorAll('{{ $rowSelector }}');

        rows.forEach(function (row) {
            var textContent = row.textContent.toLowerCase(); // Checks entire row for search filter
            var cells = row.querySelectorAll('td'); // Get all cells in the row
            var columnText = cells[{{ $columnIndex }}] ? cells[{{ $columnIndex }}].textContent.toLowerCase() : ''; // Target specific column by index
            var matchesSearch = textContent.includes(searchFilter);
            var matchesDropdown = searchOnly || dropdownFilter === '' || columnText.includes(dropdownFilter);

            row.style.display = matchesSearch && matchesDropdown ? '' : 'none';
        });
    }
</script>
