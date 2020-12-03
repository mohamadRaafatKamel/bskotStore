
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

// display Delivery
function getTree() {
    var tree = [
        {
            text: "Parent 1",
            icon: "glyphicon glyphicon-stop",
            selectedIcon: "glyphicon glyphicon-stop",
            nodes: [
                {
                    text: "Child 1",
                    nodes: [
                        {
                            text: "Grandchild 1"
                        },
                        {
                            text: "Grandchild 2"
                        }
                    ]
                },
                {
                    text: "Child 2"
                }
            ]
        },
        {
            text: "Parent 2"
        },
        {
            text: "Parent 3"
        },
        {
            text: "Parent 4"
        },
        {
            text: "Parent 5"
        }
    ];

    return tree;
}

$('#tree').treeview({data: getTree() ,showIcon: true});

