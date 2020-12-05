
// Delivery

// get data
// $(document).ready(function(){
//     $.ajax({
//         url: "fetch.php",
//         method:"POST",
//         dataType: "json",
//         success: function(data)
//         {
//             $('#treeview').treeview({data: data});
//         }
//     });
//
// });



// $('#tree').treeview({
//     data: getTree(),
//     clearSearch: true,
//     expandIcon: 'fa fa-angle-down fa-fw',
//     collapseIcon: 'fa fa-angle-right fa-fw',
// });
// // var checked = $('#tree').treeview('getChecked');
// // console.log(checked);
// var search = function(e) {
//     var pattern = $('#input-search').val();
//     var options = {
//         ignoreCase: $('#chk-ignore-case').is(':checked'),
//         exactMatch: $('#chk-exact-match').is(':checked'),
//         revealResults: $('#chk-reveal-results').is(':checked')
//     };
//     var results = $searchableTree.treeview('search', [ pattern, options ]);
//
//     var output = '<p>' + results.length + ' matches found</p>';
//     $.each(results, function (index, result) {
//         output += '<p>- ' + result.text + '</p>';
//     });
//     $('#search-output').html(output);
// }

// display Delivery
function getTree() {
    var tree = [
        {
            text: 'Parent 1',
            href: '#parent1',
            tags: ['4'],
            nodes: [
                {
                    text: 'Child 1',
                    href: '#child1',
                    tags: ['2'],
                    nodes: [
                        {
                            text: 'Grandchild 1',
                            href: '#grandchild1',
                            tags: ['0']
                        },
                        {
                            text: 'Grandchild 2',
                            href: '#grandchild2',
                            tags: ['0']
                        }
                    ]
                },
                {
                    text: 'Child 2',
                    href: '#child2',
                    tags: ['0']
                }
            ]
        },
        {
            text: 'Parent 2',
            href: '#parent2',
            tags: ['0']
        },
        {
            text: 'Parent 3',
            href: '#parent3',
            tags: ['0']
        },
        {
            text: 'Parent 4',
            href: '#parent4',
            tags: ['0']
        },
        {
            text: 'Parent 5',
            href: '#parent5'  ,
            tags: ['0']
        }
    ];

    return tree;
}

$(function() {


    var $searchableTree = $('#treeview-searchable').treeview({
        data: getTree(),
    });

    var search = function (e) {
        var pattern = $('#input-search').val();

        var results = $searchableTree.treeview('search', [pattern, options]);

        var output = '<p>' + results.length + ' matches found</p>';
        $.each(results, function (index, result) {
            output += '<p>- ' + result.text + '</p>';
        });
        $('#search-output').html(output);
    }

    $('#btn-search').on('click', search);
    $('#input-search').on('keyup', search);

    $('#btn-clear-search').on('click', function (e) {
        $searchableTree.treeview('clearSearch');
        $('#input-search').val('');
        $('#search-output').html('');
    });

});
