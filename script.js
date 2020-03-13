var game_num = -1;

function clear() {
    let size = Number($(`#table`).attr(`size`));
    for (let i = 0; i < size; ++i){
        for (let j = 0; j < size; ++j){
            let str = `img[x=` + i.toString() + `][y=` + j.toString() + `]`;
            let $cell = $(str);
            $cell.attr(`src`, ``);
        }
    }
}

function choice(){
    if (game_num === -1){
        return;
    }
    let x = this.x;
    let y = this.y;
    $.ajax({
        url: `choice.php`,
        method: `POST`,
        data: {
            x: x,
            y: y,
            game: game_num
        },
        dataType: `text`,
        success : function (data) {
            // let res = Number(data);
            alert(data);
            // if(data === -1){
            //     alert("Draw!");
            // }
            // else if (data === 0 || data === 1){
            //     let path;
            //     if (data === 0) {
            //         path = `krest.jpg`;
            //     }
            //     else{
            //         path = `zero.webp`;
            //     }
            //     alert(0);
            //     let str = `img[x=` + x.toString() + `][y=` + y.toString() + `]`;
            //     let $cell = $(str);
            //     $cell.attr(`src`, path);
            // }
            // else if(data === 2){
            //     alert(`First player wins!`);
            // }
            // else if(data === 3){
            //     alert(`Second player wins!`);
            // }
        }
    })
}

function create_game(){
    let size = $(`#table`).attr('size');
    $.ajax({
        url: `create_game.php`,
        method: `POST`,
        dataType: `text`,
        data: {
          size: size
        },
        success: function (data){
            let code = Number(data);
            if (code === -1){
                alert("Your size of field is incorrect!");
            }
            else if (code === -2) {
                alert("Hacker!");
            }
            else {
                game_num = code;
                alert(game_num);
            }
            clear();
        }
    })
}

function join_game(){
    let num = Number($(`#text_for_join_game`).val());
    $.ajax({
        url: `join_game.php`,
        method: `POST`,
        dataType: `text`,
        data: {
            num: num
        },
        success: function (data) {
            let ret = Number(data);
            if (ret === -1){
                alert(`The code of game is incorrect!`)
            }
            else if (ret === -2) {
                alert("Hacker!");
            }
            else {
                alert(`You're joined!`);
            }
        }
    })
}
$(document).ready(function () {
    let count = 5;
    let $field = $(`#table`);
    $field.attr(`size`, count);
    let cell_width = $field.width() / count;
    let cell_height = $field.width() / count;
    for (let i = 0; i < count; ++i) for (let j = 0; j < count; ++j) {
        let $cell = $(`<img alt="">`);
        $cell.attr(`x`, i);
        $cell.attr(`y`, j);
        $cell.css(`display`, `inline-block`);
        $cell.css(`height`, cell_height + `px`);
        $cell.css(`width`, cell_width + `px`);
        $cell.css(`border-width`, `0`);
        $cell.css(`left`, cell_width * i);
        $cell.css(`top`, cell_height * j);
        $cell.click(choice);
        $field.append($cell);
    }
});

