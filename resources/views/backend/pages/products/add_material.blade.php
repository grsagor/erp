<tr class="product-material-table-tr-{{ $time }}">
    <td>
        <select name="material_id[]" class="form-control" required>
            <option value="">Select</option>
            @foreach ($material_types as $type)
            <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </select>
    </td>
    <td>
        <input type="number" name="material_quantity[]" class="form-control"
            placeholder="Quantity" required>
    </td>
    <td class="product-mateial-delete-btn"><button type="button"
            data-no="{{ $time }}" data-container="#product-material-add-table tbody">Delete</button></td>
</tr>