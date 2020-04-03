$(() => {
    $('#close').on('click', () => {
        $.ajax({
            url: `close`,
            method: "post",
            dataType: "json",
            success: () => location.reload()
        });
    });

    $('#accept').on('click', () => {
        $.ajax({
            url: `accept`,
            method: "post",
            dataType: "json",
            success: () => location.reload()
        });
    });
});
