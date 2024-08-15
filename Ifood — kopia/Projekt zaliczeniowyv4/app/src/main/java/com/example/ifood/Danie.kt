package com.example.ifood

import androidx.core.util.ObjectsCompat.toString
import androidx.room.Entity
import androidx.room.PrimaryKey
import java.util.*
import java.util.Objects.toString
import kotlin.Unit.toString
import kotlin.random.Random
import kotlin.time.TimeSource.Monotonic.toString
@Entity
data class Danie(

    var idDania: Int,
    var miejsceZakupuDania: String ="",
    var nazwaDania: String ="",
    var ocenaDania: String

        )






















