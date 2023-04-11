{{-- 导出 --}}
<div class="custom-data-table-header">
    <div class="table-responsive">
        <div class="top d-block clearfix p-0">
            <div class="pull-right">
                <button type="button" class="btn btn-white btn-mini" id="export-form-data">导出全部</button> 
            </div>
        </div>
    </div>
</div>
<div class="dcat-box">
    {{-- 表格 --}}
    <div class="table-responsive table-wrapper complex-container table-middle mt-1 table-collapse ">
        <table class="table custom-data-table data-table" id="diy-form-data" >
            <thead>
            @if($columns)
                @foreach($columns as $column)
                    <th>{{ $column }}</th> 
                @endforeach 
            @endif
            </thead>

            <tbody>
            @if($data['data'])
                @foreach($data['data'] as $value)
                    <tr>
                        @foreach($value as $v)
                            <td>{{ $v }}</td> 
                        @endforeach
                    </tr>  
                @endforeach 
            @else
                <tr>
                    <td colspan="{{ count($columns) }}">
                        <div style="margin:5px 0 0 10px;"><span class="help-block" style="margin-bottom:0"><i class="feather icon-alert-circle"></i>&nbsp;{{ trans('admin.no_data') }}</span></div>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    {{-- 分页 --}}
    <div class="box-footer d-block clearfix ">
        <ul class="pagination pagination-sm no-margin pull-right shadow-100" style="border-radius: 1.5rem">
        @if($data['links'])
            @foreach($data['links'] as $link)
                @if (strpos($link['label'], 'Previous') !== false)
                {{-- 首页 --}}
                <li class="page-item"><a class="page-link" href="{{ $link['url'] }}"> &laquo; </a></li>
                @elseif (strpos($link['label'], 'Next') !== false)
                {{-- 尾页 --}}
                <li class="page-item"><a class="page-link" href="{{ $link['url'] }}"> &raquo; </a></li>
                @else
                <li class="page-item"><a class="page-link" href="{{ $link['url'] }}">{{ $link['label'] }}</a></li>
                {{-- <li class="page-item"><a class="page-link" href="{{ $link['url'] }}"></a></li> --}}
                @endif
            @endforeach
        @endif
        </ul>
    </div>

</div>

<script>
    $("#export-form-data").click(function () {
        window.open("/admin/diy-form/export/formData?id="+{{ $id }})
    })
</script>
