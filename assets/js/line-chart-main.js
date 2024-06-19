import { TransazioniSingleton } from './TransazioniSingleton.js'
import { drawChart } from './lineChart.js'
import { updateTransazioniTable } from './transazioni_list.js'

TransazioniSingleton.addObserver(drawChart)
TransazioniSingleton.addObserver(updateTransazioniTable)

TransazioniSingleton.fetch()
TransazioniSingleton.update()
