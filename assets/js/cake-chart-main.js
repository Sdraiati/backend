import { TransazioniSingleton } from './TransazioniSingleton.js'
import { drawCakeChart } from './cakeChart.js'
import { updateTransazioniTable } from './transazioni_list.js'

TransazioniSingleton.addObserver(drawCakeChart)
TransazioniSingleton.addObserver(updateTransazioniTable)

TransazioniSingleton.fetch()
TransazioniSingleton.update()