function deleteItem(table, id) {
    const data = new FormData();
    data.append('table', table);
    data.append('id', id);

    fetch('deleteItems', {
        method: 'POST',
        body: data
    })
}

function test(table, id){
    alert(table + id)
}