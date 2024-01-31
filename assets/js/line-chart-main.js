import { Transazione } from './transazione.js'
import { draw_chart } from './lineChart.js'

Transazione.addObserver(draw_chart)

Transazione.fetch()
Transazione.update()
