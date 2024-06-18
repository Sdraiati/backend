import { TransazioniSingleton } from './TransazioniSingleton.js'
import { drawCakeChart } from './cakeChart.js'
import { update_transazioni_table } from './transazioni_list.js'

TransazioniSingleton.addObserver(drawCakeChart)
TransazioniSingleton.addObserver(update_transazioni_table)

TransazioniSingleton.fetch()
TransazioniSingleton.update()