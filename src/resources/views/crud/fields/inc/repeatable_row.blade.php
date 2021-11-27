
<div class="col-md-12 well repeatable-element row m-1 p-2" data-repeatable-identifier="{{ $field['name'] }}">
    @if (isset($field['fields']) && is_array($field['fields']) && count($field['fields']))
    <div class="controls">
        <button type="button" class="close delete-element"><span aria-hidden="true">×</span></button>
        <button type="button" class="close move-element-up">
            <svg viewBox="0 0 64 80"><path d="M46.8,36.7c-4.3-4.3-8.7-8.7-13-13c-1-1-2.6-1-3.5,0c-4.3,4.3-8.7,8.7-13,13c-2.3,2.3,1.3,5.8,3.5,3.5c4.3-4.3,8.7-8.7,13-13c-1.2,0-2.4,0-3.5,0c4.3,4.3,8.7,8.7,13,13C45.5,42.5,49,39,46.8,36.7L46.8,36.7z"/></svg>
        </button>
        <button type="button" class="close move-element-down">
            <svg viewBox="0 0 64 80"><path d="M17.2,30.3c4.3,4.3,8.7,8.7,13,13c1,1,2.6,1,3.5,0c4.3-4.3,8.7-8.7,13-13c2.3-2.3-1.3-5.8-3.5-3.5c-4.3,4.3-8.7,8.7-13,13c1.2,0,2.4,0,3.5,0c-4.3-4.3-8.7-8.7-13-13C18.5,24.5,15,28,17.2,30.3L17.2,30.3z"/></svg>
        </button>
    </div>
    @foreach($field['fields'] as $subfield)
        @php
            $subfield = $crud->makeSureFieldHasNecessaryAttributes($subfield);
            $fieldViewNamespace = $subfield['view_namespace'] ?? 'crud::fields';
            $fieldViewPath = $fieldViewNamespace.'.'.$subfield['type'];
            if(isset($row)) {
                if(!is_array($subfield['name'])) {
                    // this is a fix for 4.1 repeatable names that when the field was multiple, saved the keys with `[]` in the end. Eg: `tags[]` instead of `tags`
                    if(isset($row[$subfield['name']]) || isset($row[$subfield['name'].'[]'])) {
                        $subfield['value'] = $row[$subfield['name']] ?? $row[$subfield['name'].'[]'];
                    }
                }else{
                    $subfield['value'] = $row;
                }
            }                       
        @endphp

        @include($fieldViewPath, ['field' => $subfield])
    @endforeach

    @endif
</div>