import { TransazioniSingleton } from './TransazioniSingleton.js'
import { draw_chart } from './lineChart.js'
import { update_transazioni_table } from './transazioni_list.js'

TransazioniSingleton.addObserver(draw_chart)
TransazioniSingleton.addObserver(update_transazioni_table)

TransazioniSingleton.fetch()
TransazioniSingleton.update()
