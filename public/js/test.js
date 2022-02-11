

let invoice = {
    invoice: [
        "JKT-1-2021",
        "JKT-2-2021",
        "JKT-3-2021",
        "JKT-4-2021",
        "JKT-5-2021",
        "JKT-1-2022",
        "JKT-2-2022",
    ],
    reimbursment: [
        "R-JKT-1-2021",
        "R-JKT-2-2021",
        "R-JKT-3-2021",
        "R-JKT-4-2021",
        "R-JKT-5-2021",
    ]
}

let year = new Date().getFullYear()

console.log(year)

function getInvoiceNumber(type) {
    if (type == "reimbursment") {
        let latest = invoice.reimbursment[invoice.reimbursment.length - 1].match(/[A-Z0-9]+/g)
        if (latest[3] == year) {
            latest[3] = year
            latest[2] = parseInt(latest[2]) + 1
            return latest.join('-')
        } else {
            latest[3] = year
            latest[2] = 1
            return latest.join('-')
        }
    } else {
        let latest = invoice.invoice[invoice.invoice.length - 1].match(/[A-Z0-9]+/g)
        if (latest[2] == year) {
            latest[2] = year
            latest[1] = parseInt(latest[1]) + 1
            return latest.join('-')
        } else {
            latest[2] = year
            latest[1] = 1
            return latest.join('-')
        }
    }

}

console.log(getInvoiceNumber('invoice'))


function bouncer(arr) {
    return arr.filter(item => item != false && item != null && item != undefined && !Number.isNaN(item))
}

console.log(bouncer([7, "ate", "", false, 9]))
console.log(bouncer([false, null, 0, NaN, undefined, ""]))

console.log('60,737,081 (71)'.match(/[\S]+/g)[1].match(/[0-9]+/g))
console.log('60,737,081 (71)'.trim())
