import { TransazioniSingleton } from './TransazioniSingleton.js'

var PALETTE = []/*= ["#D25AF3", "#3DA179", "#BB891C", "#8264C7", "#3D9AA0", "#808059", "#E9476A", "#CE4129", "#8D69D0", "#AE7D22", "#5293C4", "#CF298A", "#BF5A5A", "#779F19", "#548461", "#989021"]*/;
const LEGEND_LIMIT = 6;
const elementId = "cake-chart"

const degreesToRads = deg => (deg * Math.PI) / 180.0;
const invertYaxis = angle => 360 - angle;

function generateRandomColor() {
    let color = Math.floor(Math.random() * 16777215).toString(16);
    while (color.length < 6) {
        color = "0" + color;
    }
    return '#' + color;
}


class Legend {
    #x;
    #y;
    #context;
    #colors;
    #items;
    #width;
    #height;

    constructor(ctx, colors, items, elongated = false, xPercent = 80, yPercent = 10, widthPercent = 15, heightPercent = 20) {
        this.#context = ctx;
        const canvas = this.#context.canvas;
        this.#x = xPercent / 100 * canvas.width;
        this.#y = yPercent / 100 * canvas.height;
        this.#width = widthPercent / 100 * canvas.width;
        this.#height = heightPercent / 100 * canvas.height;
        this.#colors = colors;
        this.#items = items;

        this.#context.beginPath();
        if (elongated) this.#context.rect(this.#x, this.#y, this.#width, this.#height * 2);
        else this.#context.rect(this.#x, this.#y, this.#width, this.#height);
        this.#context.closePath();
        this.#context.stroke();

        const itemSize = Math.min((this.#height - 20) / this.#items.length, 20);
        const totalItemHeight = itemSize * this.#items.length;
        const totalPadding = this.#height - totalItemHeight;
        const paddingTop = totalPadding / (this.#items.length + 1);

        let item_x = this.#x + 10;
        let item_y = this.#y + paddingTop;

        for (let i = 0; i < this.#colors.length - 1 && i < this.#items.length; i++) {
            this.insertItem(item_x, item_y, this.#colors[i + 1], this.#items[i], itemSize);
            item_y += itemSize + paddingTop;
        }
    }

    insertItem(x, y, color, text, size) {
        this.#context.beginPath();
        this.#context.rect(x, y, size, size);
        this.#context.fillStyle = color;
        this.#context.fill();
        this.#context.font = `${size * 1}px Arial`;
        this.#context.fillText(text, x + size + 10, y + size * 0.75);
        this.#context.closePath();
        this.#context.stroke();
    }
}


class Cake {
    static total_angle = 360;
    #x;
    #y;
    #radius;
    #offset_angle;
    #last_angle;
    #used_angle;
    #context;
    #total_data;
    #used_colors;
    #palette_index;
    #legend;

    constructor(x, y, radius, ctx, offset_angle = 0, total = 100) {
        this.#used_angle = 0;
        this.#offset_angle = offset_angle;
        this.#last_angle = offset_angle;
        this.#x = x;
        this.#y = y;
        this.#radius = radius;
        this.#context = ctx;
        this.#total_data = total;
        this.#used_colors = ["#ffffff"];
        this.#palette_index = 0;
        this.#legend = null;

        this.#context.beginPath();
        this.#context.arc(this.#x, this.#y, this.#radius, 0, 2 * Math.PI);
        this.#context.fillStyle = this.#used_colors[0];
        this.#context.fill();
    }


    setTotalData(total) { this.#total_data = total; }

    getUsedColors() { return this.#used_colors; }

    getColor() {
        let color;
        do {
            color = generateRandomColor();
        } while (this.#used_colors.includes(color));

        return color;
    }

    getPaletteColor() {
        let color = PALETTE[this.#palette_index];
        if (this.#palette_index === PALETTE.length - 1) {
            //palette overflow
            return this.getColor();
        }
        ++this.#palette_index;
        return color;
    }

    createSliceLine(angle) {
        let inv_angle = invertYaxis(angle);
        let rad_angle = degreesToRads(inv_angle);

        this.#context.moveTo(this.#x, this.#y);

        let x_dest = this.#x + this.#radius * Math.cos(rad_angle);
        let y_dest = this.#y + this.#radius * Math.sin(rad_angle);

        this.#context.lineTo(x_dest, y_dest);
        return rad_angle;
    }

    addSlice(angle) {
        this.#context.closePath();
        this.#context.stroke();

        this.#last_angle = this.#offset_angle + this.#used_angle;
        if (angle > Cake.total_angle - this.#used_angle) { console.log("Overflow usable angle"); return -1; }
        else {
            this.#context.beginPath();

            let end_angle = this.createSliceLine(this.#last_angle);

            let start_angle = this.createSliceLine(this.#last_angle + angle);

            this.#context.arc(this.#x, this.#y, this.#radius, start_angle, end_angle);

            this.#used_colors.push(this.getPaletteColor());

            this.#context.fillStyle = this.#used_colors[this.#used_colors.length - 1];
            this.#context.fill();

            this.#context.closePath();
            this.#context.stroke();

            this.#used_angle += angle;

            return 0;
        }
    }

    addSliceFromData(data) {
        let angle = (data / this.#total_data) * 360;
        return this.addSlice(angle);
    }

    createLegend(items) {
        if (items.length > LEGEND_LIMIT) this.#legend = new Legend(this.#context, this.#used_colors, items, true);
        else this.#legend = new Legend(this.#context, this.#used_colors, items);
    }
}

function isInsideCanvas(x, y, canvas) {
    return x >= 0 && x <= canvas.width && y >= 0 && y <= canvas.height;
}

function resizeCanvas(canvas) {
    const computedStyle = getComputedStyle(canvas);
    const cssWidth = parseInt(computedStyle.getPropertyValue('width'), 10);
    const cssHeight = parseInt(computedStyle.getPropertyValue('height'), 10);

    canvas.width = cssWidth;
    canvas.height = cssHeight;
}

/** Disegna il grafico a torta
 * @param {Transazione[]} transactions - Array di transazioni
 */
async function drawCakeChart(transactions) {
    //check if no transactions is given
    if (transactions.length !== 0) {
        let period = TransazioniSingleton.getPeriod();
        let BEGIN = period.begin;
        let END = period.end;

        let filtered_transactions = transactions.filter((transazione) => {
            return transazione.data >= BEGIN && transazione.data <= END;
        });

        let grouped_transactions = {};
        filtered_transactions.forEach((transazione) => {
            if (!grouped_transactions[transazione.tag]) {
                grouped_transactions[transazione.tag] = 0;
            }
            grouped_transactions[transazione.tag] += transazione.importo;
        });

        let total_amount = Object.values(grouped_transactions).reduce((acc, importo) => acc + importo, 0);

        let categories = Object.keys(grouped_transactions);
        let amounts = Object.values(grouped_transactions);

        let canvas = document.getElementById(elementId);
        let ctx = canvas.getContext("2d");

        resizeCanvas(canvas);

        let radius = Math.min(canvas.width, canvas.height) / 2;
        let offset_x = canvas.width * 0.5;
        let offset_y = canvas.height * 0.5;

        if (!isInsideCanvas(offset_x, offset_y, canvas)) {
            console.error(`Le coordinate x=${offset_x}, y=${offset_y} sono fuori dai limiti del canvas.`);
            return;
        }

        //get color palette
        PALETTE=getComputedStyle(canvas).getPropertyValue('--palette').split(',');

        let cake = new Cake(offset_x, offset_y, radius, ctx, 90, total_amount);
        cake.setTotalData(total_amount);
        categories.forEach((tag, index) => {
            cake.addSliceFromData(amounts[index]);
        });

        cake.createLegend(categories);
    }
}

export { drawCakeChart };
