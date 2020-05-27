// $('#html_table').mDatatable();

// fungsi tampil barang
function tampil_pelanggan(page){
    mApp.block("#html_table",{
        overlayColor:"#000000",type:"loader",state:"success",message:"Mohon Tunggu..."
    });
    $.ajax({
        pageLength  : 5,
        serverSide  : true,
        processing  : true,
        type  		: 'GET',
        url   		: page,
        async 		: true,
        dataType 	: 'json',
        success : function(data){
            var html = '';
            var jum = '';
            var nav = '';
            var i;
            if(data.data.length==0){
                html += '<div class="m-stack m-stack--ver m-stack--general m-stack--demo">'+
                            '<div class="m-stack__item m-stack__item--center m-stack__item--middle">'+
                                '<span class="m-datatable--error">Tidak ada data untuk ditampilkan</span>'+
                            '</div>'+
                        '</div>'
            }else{
                for(i=0; i<data.data.length; i++){
                    html += '<tr data-row="0" class="m-datatable__row" style="left: 0px;">'+
                                '<td data-field="No" class="m-datatable__cell">'+
                                    '<span style="width: 30px;">'+(data.from+i)+'</span>'+
                                '</td>'+
                                '<td data-field="Field #2" class="m-datatable__cell m--font-transform-u">'+
                                    '<span style="width: 180px;">'+data.data[i].nama+'</span>'+
                                '</td>'+
                                '<td data-field="Field #3" class="m-datatable__cell">'+
                                    '<span style="width: 50px;">'+data.data[i].id+'</span>'+
                                '</td>'+
                                '<td data-field="Field #4" class="m-datatable__cell">'+
                                    '<span style="width: 170px;">'+data.data[i].alamat+'</span>'+
                                '</td>'+
                                '<td data-field="Field #5" class="m-datatable__cell">'+
                                    '<span style="width: 170px;">'+data.data[i].created_at+'</span>'+
                                '</td>'+
                                '<td data-field="Field #6" class="m-datatable__cell">'+
                                    '<span style="width: 170px;">'+data.data[i].updated_at+'</span>'+
                                '</td>'+
                                '<td data-field="Field #7" class="m-datatable__cell">'+
                                    '<span style="overflow: visible; position: relative; width: 80px;">'+
                                        '<a id="delete" data-toggle="modal" onclick="UbahData('+data.data[i].id+',`'+data.data[i].nama+'`,`'+data.data[i].alamat+'`)" data-target="#ubah_modal" class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" title="Ubah "><i class="fa fa-edit"></i></a> '+
                                        '<a id="delete" href="javascript:void(0)" onClick="Delete('+data.data[i].id+');" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Hapus Pelanggan "><i class="fa fa-trash-o"></i></a> '+
                                    '</span>'+
                                '</td>'+
                            '</tr>';
                }
            }
            $('#show_data').html(html);
            jum += '<span class="m-datatable__pager-detail">Menampilkan '+data.from+' - '+data.to+' dari '+data.total+' pelanggan</span>'
            var no_page = '';
            var nex = '';
            var url = url('/cabang/get_pelanggan?page=');
            for(i=0;i<data.last_page;i++){
                var aktif = '';
                if(i==data.current_page-1){
                    aktif= 'm-datatable__pager-link--active';
                }
                no_page += '<li><a href="javascript:void(0)" onclick="tampil_pelanggan(`'+url+(i+1)+'`)"  class="m-datatable__pager-link m-datatable__pager-link-number '+aktif+'" data-page="'+(i+1)+'" title="'+(i+1)+'">'+(i+1)+'</a></li>';
            }
            var prev = '';
            if(data.prev_page_url==null){
                prev = url+1;
            }else{
                prev = data.prev_page_url;
            }
            var next = '';
            if(data.next_page_url==null){
                next = url+1;
            }else{
                next = data.next_page_url;
            }
            $('#jumlah_baris').html(jum);
            nav += '<li><a href="javascript:void(0)" onclick="tampil_pelanggan(`'+data.first_page_url+'`)" class="m-datatable__pager-link m-datatable__pager-link--first" data-page="1">'+
                        '<i class="la la-angle-double-left"></i></a>'+
                    '</li>'+
                    '<li><a href="javascript:void(0)" onclick="tampil_pelanggan(`'+prev+'`)"  class="m-datatable__pager-link m-datatable__pager-link--prev" data-page="1">'+
                        '<i class="la la-angle-left"></i></a>'+
                    '</li>'+
                    '<li style="display: none;"><a title="More pages" class="m-datatable__pager-link m-datatable__pager-link--more-prev" data-page="1">'+
                        '<i class="la la-ellipsis-h"></i></a>'+
                    '</li><li style="display: none;"><input type="text" class="m-pager-input form-control" title="Page number"></li>'
            nex +=  '<li><a href="javascript:void(0)" onclick="tampil_pelanggan(`'+next+'`)" class="m-datatable__pager-link m-datatable__pager-link--next" data-page="2">'+
                        '<i class="la la-angle-right"></i></a>'+
                    '</li>'+
                    '<li><a href="javascript:void(0)" onclick="tampil_pelanggan(`'+data.last_page_url+'`)"  class="m-datatable__pager-link m-datatable__pager-link--last" data-page="15">'+
                        '<i class="la la-angle-double-right"></i></a>'+
                    '</li>'
            $('#nav-pagetable').html(nav+no_page+nex);
            mApp.unblock("#html_table");      
        }
    });
}